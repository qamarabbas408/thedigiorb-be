import apiClient from '../client';
import { Contact } from '../../types';

export const contactsApi = {
  submit: async (data: {
    name: string;
    email: string;
    phone?: string;
    subject?: string;
    message: string;
  }): Promise<Contact> => {
    const response = await apiClient.post('/contacts', data);
    return response.data;
  },

  getAll: async (): Promise<Contact[]> => {
    const response = await apiClient.get('/contacts');
    const data = response.data.data || response.data;
    return data as Contact[];
  },

  markAsRead: async (id: string | number): Promise<void> => {
    await apiClient.patch(`/contacts/${id}`, { status: 'read' });
  },
};
