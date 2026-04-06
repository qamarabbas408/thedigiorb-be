import apiClient from '../client';
import { TeamMember } from '../../types';
import { processImageUrls } from '../utils';

export const teamApi = {
  getAll: async (): Promise<TeamMember[]> => {
    const response = await apiClient.get('/team');
    const data = response.data.data || response.data;
    return Array.isArray(data) ? data.map((item: TeamMember) => processImageUrls(item, ['image'])) : data;
  },

  getActive: async (): Promise<TeamMember[]> => {
    const response = await apiClient.get('/team?status=published');
    const data = response.data.data || response.data;
    return Array.isArray(data) ? data.map((item: TeamMember) => processImageUrls(item, ['image'])) : data;
  },

  getById: async (id: string | number): Promise<TeamMember> => {
    const response = await apiClient.get(`/team/${id}`);
    const data = response.data.data || response.data;
    return processImageUrls(data, ['image']);
  },
};
