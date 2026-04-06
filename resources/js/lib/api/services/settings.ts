import apiClient from '../client';
import { Settings } from '../../types';

export const settingsApi = {
  getAll: async (): Promise<Settings> => {
    const response = await apiClient.get('/settings');
    const data = response.data.data || response.data;
    return data as Settings;
  },
};
