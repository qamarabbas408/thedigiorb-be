import { useMutation } from '@tanstack/react-query';
import { contactsApi } from '@/lib/api';

export const useSubmitContact = () => {
  return useMutation({
    mutationFn: (data: {
      name: string;
      email: string;
      phone?: string;
      subject?: string;
      message: string;
    }) => contactsApi.submit(data),
  });
};
