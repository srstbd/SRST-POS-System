import { useApi } from "@/composables/useApi";

export const createSale = async (saleData: any) => {
  const api = useApi();
  return await api.post("/sales", saleData);
};
