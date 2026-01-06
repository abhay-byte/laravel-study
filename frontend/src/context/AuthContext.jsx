import { createContext, useState, useEffect } from "react";
import api from '../api';

export const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
    const [user, setUser] = useState(null);
    const [token, setToken] = useState(localStorage.getItem('token'));

    useEffect(() => {
        if (token) {
            api.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            localStorage.setItem('token', token);
        } else {
            delete api.defaults.headers.common['Authorization'];
            localStorage.removeItem('token');
        }
    }, [token]);

    const login = async (email, password) => {
        const response = await api.post('/login', { email, password });
        setToken(response.data.token);
        setUser(response.data.user);
        return response;
    };

    const register = async (name, email, password, password_confirmation) => {
        const response = await api.post('/register', { name, email, password, password_confirmation });
        setToken(response.data.token);
        setUser(response.data.user);
        return response;
    };

    const logout = async () => {
        await api.post('/logout');
        setToken(null);
        setUser(null);
    };

    return (
        <AuthContext.Provider value={{ user, token, login, register, logout }}>
            {children}
        </AuthContext.Provider>
    );
};
