import axios, {AxiosError, AxiosResponse} from "axios";

export function isAxiosError(e: unknown): e is AxiosError {
    return e instanceof Error && "isAxiosError" in e;
}

export function httpGet(url: string): Promise<AxiosResponse<any>> {
    return axios.get(url, {})
}

export function httpPost(url: string, data: object) {
    return axios.post(url, data)
}