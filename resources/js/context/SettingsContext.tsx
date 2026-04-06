import { createContext, useContext, ReactNode } from 'react';
import { useSettings } from '@/hooks';
import { Settings } from '@/lib/api/types';

interface SettingsContextType {
  settings: Settings | undefined;
  loading: boolean;
  error: Error | null;
}

const defaultSettings: Settings = {
  company_name: 'DigitalOrbit',
  company_email: 'support@thedigiorb.com',
  company_phone: '+92 311 1588908',
  company_address: '',
  company_description: 'Building innovative digital solutions for your business.',
  logo_type: 'text',
  logo_image: '',
  logo_text: '',
  favicon: '',
  facebook_url: '#',
  twitter_url: '#',
  linkedin_url: '#',
  instagram_url: '#'
};

const SettingsContext = createContext<SettingsContextType>({
  settings: defaultSettings,
  loading: true,
  error: null
});

export function useSettingsContext() {
  return useContext(SettingsContext);
}

export { useSettingsContext as useSettings };

export function SettingsProvider({ children }: { children: ReactNode }) {
  const { data, isLoading, error } = useSettings();
  
  const settings = data || defaultSettings;
  
  return (
    <SettingsContext.Provider value={{ 
      settings, 
      loading: isLoading,
      error 
    }}>
      {children}
    </SettingsContext.Provider>
  );
}

export { defaultSettings };
