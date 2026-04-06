import apiClient from '../client';
import { Stat } from '../../types';

export const statsApi = {
  getAll: async (): Promise<Stat[]> => {
    const response = await apiClient.get('/stats');
    const data = response.data.data || response.data;
    return data as Stat[];
  },

  getBySection: async (section: string): Promise<Stat[]> => {
    const response = await apiClient.get(`/stats?section=${section}`);
    const data = response.data.data || response.data;
    return data as Stat[];
  },
};
