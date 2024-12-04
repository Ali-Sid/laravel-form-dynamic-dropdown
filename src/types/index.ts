export type CategoryType = 'course' | 'live-class';

export interface FormData {
  title: string;
  description: string;
  category: CategoryType;
  price: number;
  // Live class specific fields
  meetingDate?: string;
  meetingTime?: string;
  meetingName?: string;
  timezone?: string;
}