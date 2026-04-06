import { useQuery } from '@tanstack/react-query';
import { settingsApi } from '@/lib/api';

export const useSettings = () => {
  return useQuery({
    queryKey: ['settings'],
    queryFn: () => settingsApi.getAll(),
    staleTime: 1000 * 60 * 5,
  });
};
