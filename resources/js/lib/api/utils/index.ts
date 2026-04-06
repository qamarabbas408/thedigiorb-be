import { CONTENT_URL } from '../ApiConstants';

export const processImageUrls = <T extends Record<string, any>>(
  item: T,
  imageFields: (keyof T)[]
): T => {
  const processed = { ...item };
  
  imageFields.forEach((field) => {
    if (processed[field] && typeof processed[field] === 'string') {
      processed[field] = processImageUrl(processed[field]);
    }
  });
  
  return processed;
};

export const processImageUrl = (url: string): string => {
  if (!url) return url;
  if (url.startsWith('http://') || url.startsWith('https://')) {
    return url;
  }
  return CONTENT_URL + url;
};
