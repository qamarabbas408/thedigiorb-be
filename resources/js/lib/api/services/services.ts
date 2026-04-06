import apiClient from '../client';
import { Service } from '../../types';

export const servicesApi = {
  getAll: async (): Promise<Service[]> => {
    const response = await apiClient.get('/services');
    const data = response.data.data || response.data;
    return data as Service[];
  },

  getPublished: async (): Promise<Service[]> => {
    const response = await apiClient.get('/services?status=published');
    const data = response.data.data || response.data;
    return data as Service[];
  },

  getFeatured: async (): Promise<Service[]> => {
    const response = await apiClient.get('/services?featured=true');
    const data = response.data.data || response.data;
    return data as Service[];
  },

  getById: async (id: string | number): Promise<Service> => {
    const response = await apiClient.get(`/services/${id}`);
    const data = response.data.data || response.data;
    return data as Service;
  },
};
