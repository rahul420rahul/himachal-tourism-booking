// API helper for Laravel backend
const API_BASE = '/api';

class ApiService {
    constructor() {
        this.token = document.querySelector('meta[name="csrf-token"]')?.content;
    }
    
    async request(url, options = {}) {
        const config = {
            ...options,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': this.token,
                'Accept': 'application/json',
                ...options.headers
            }
        };
        
        const response = await fetch(`${API_BASE}${url}`, config);
        
        if (!response.ok) {
            throw new Error(`API Error: ${response.statusText}`);
        }
        
        return response.json();
    }
    
    get(url) {
        return this.request(url, { method: 'GET' });
    }
    
    post(url, data) {
        return this.request(url, {
            method: 'POST',
            body: JSON.stringify(data)
        });
    }
    
    put(url, data) {
        return this.request(url, {
            method: 'PUT',
            body: JSON.stringify(data)
        });
    }
    
    delete(url) {
        return this.request(url, { method: 'DELETE' });
    }
}

export default new ApiService();
