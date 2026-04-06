import { useQuery } from '@tanstack/react-query';
import { testimonialsApi } from '@/lib/api';

export const useTestimonials = () => {
  return useQuery({
    queryKey: ['testimonials'],
    queryFn: () => testimonialsApi.getAll(),
  });
};

export const usePublishedTestimonials = () => {
  return useQuery({
    queryKey: ['testimonials', 'published'],
    queryFn: () => testimonialsApi.getPublished(),
  });
};

export const useFeaturedTestimonials = () => {
  return useQuery({
    queryKey: ['testimonials', 'featured'],
    queryFn: () => testimonialsApi.getFeatured(),
  });
};
