import { useQuery } from '@tanstack/react-query';
import { statsApi } from '@/lib/api';

export const useStats = () => {
  return useQuery({
    queryKey: ['stats'],
    queryFn: () => statsApi.getAll(),
  });
};

export const useStatsBySection = (section: string) => {
  return useQuery({
    queryKey: ['stats', section],
    queryFn: () => statsApi.getBySection(section),
    enabled: !!section,
  });
};
