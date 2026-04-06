import apiClient from '../client';
import { Testimonial } from '../../types';
import { processImageUrls } from '../utils';

export const testimonialsApi = {
  getAll: async (): Promise<Testimonial[]> => {
    const response = await apiClient.get('/testimonials');
    const data = response.data.data || response.data;
    return Array.isArray(data) ? data.map((item: Testimonial) => processImageUrls(item, ['image'])) : data;
  },

  getPublished: async (): Promise<Testimonial[]> => {
    const response = await apiClient.get('/testimonials?status=published');
    const data = response.data.data || response.data;
    return Array.isArray(data) ? data.map((item: Testimonial) => processImageUrls(item, ['image'])) : data;
  },

  getFeatured: async (): Promise<Testimonial[]> => {
    const response = await apiClient.get('/testimonials?featured=true');
    const data = response.data.data || response.data;
    return Array.isArray(data) ? data.map((item: Testimonial) => processImageUrls(item, ['image'])) : data;
  },
};
