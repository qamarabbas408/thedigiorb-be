import apiClient from '../client';
import { Category } from '../../types';

export const categoriesApi = {
  getAll: async (): Promise<Category[]> => {
    const response = await apiClient.get('/portfolio/categories');
    const data = response.data.data || response.data;
    return data as Category[];
  },
};
