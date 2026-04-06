import { useQuery, useMutation } from '@tanstack/react-query';
import { servicesApi } from '@/lib/api';

export const useServices = () => {
  return useQuery({
    queryKey: ['services'],
    queryFn: () => servicesApi.getAll(),
  });
};

export const usePublishedServices = () => {
  return useQuery({
    queryKey: ['services', 'published'],
    queryFn: () => servicesApi.getPublished(),
  });
};

export const useFeaturedServices = () => {
  return useQuery({
    queryKey: ['services', 'featured'],
    queryFn: () => servicesApi.getFeatured(),
  });
};

export const useServiceById = (id: string | number) => {
  return useQuery({
    queryKey: ['service', id],
    queryFn: () => servicesApi.getById(id),
    enabled: !!id,
  });
};
