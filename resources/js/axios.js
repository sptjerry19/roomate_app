import axios from "axios";

// Tạo một axios instance
const apiClient = axios.create({
    baseURL: "https://aahome.click/api/v1", // Thay thế bằng URL API của bạn
    // baseURL: "http://localhost:8080/api/v1", // Thay thế bằng URL API của bạn
    headers: {
        "Content-Type": "application/json",
    },
});

// Thêm interceptor để thêm token vào request
apiClient.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem("access_token");
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

// Thêm interceptor để xử lý lỗi response
apiClient.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response && error.response.status === 401) {
            localStorage.removeItem("access_token");
            localStorage.removeItem("user");
            window.location.href = "/login"; // Chuyển hướng về trang /login
        }
        return Promise.reject(error);
    }
);

// Tương tự cho axiosInstance
const axiosInstance = axios.create({
    baseURL: "https://aahome.click/api/v1", // Thay thế bằng URL API của bạn
    // baseURL: "http://127.0.0.1:8000/api/v1", // Thay thế bằng URL API của bạn
    headers: {
        "Content-Type": "application/json",
    },
});

axiosInstance.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem("access_token");
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

axiosInstance.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response && error.response.status === 401) {
            localStorage.removeItem("access_token");
            window.location.href = "/login"; // Chuyển hướng về trang /login
        }
        return Promise.reject(error);
    }
);

export const adminApiClient = apiClient;
export const defaultApiClient = axiosInstance;
export default apiClient;
