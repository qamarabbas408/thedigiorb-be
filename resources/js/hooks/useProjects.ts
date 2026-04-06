import { useQuery } from '@tanstack/react-query';
import { projectsApi } from '@/lib/api';

export const useProjects = () => {
  return useQuery({
    queryKey: ['projects'],
    queryFn: () => projectsApi.getAll(),
  });
};

export const usePublishedProjects = () => {
  return useQuery({
    queryKey: ['projects', 'published'],
    queryFn: () => projectsApi.getPublished(),
  });
};

export const useProjectById = (id: string | number) => {
  return useQuery({
    queryKey: ['project', id],
    queryFn: () => projectsApi.getById(id),
    enabled: !!id,
  });
};

export const useProjectsByCategory = (categoryId: string) => {
  return useQuery({
    queryKey: ['projects', 'category', categoryId],
    queryFn: () => projectsApi.getByCategory(categoryId),
    enabled: !!categoryId,
  });
};

export const useFeaturedProjects = () => {
  return useQuery({
    queryKey: ['projects', 'featured'],
    queryFn: () => projectsApi.getFeatured(),
  });
};
