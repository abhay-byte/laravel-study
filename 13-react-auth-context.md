# Learning React: Auth Context

We use React Context to manage authentication state globally across the application.

## 1. Creating Context
`AuthContext.jsx` creates the context and a provider component.

```jsx
import { createContext, useState, useEffect } from 'react';
import api from '../api';

export const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
    const [user, setUser] = useState(null);
    const [token, setToken] = useState(localStorage.getItem('token'));

    // ...
```

## 2. Managing Token
We use `localStorage` to persist the token across refreshes and setting it in default Axios headers.

```jsx
    useEffect(() => {
        if (token) {
            api.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            localStorage.setItem('token', token);
        } else {
            delete api.defaults.headers.common['Authorization'];
            localStorage.removeItem('token');
        }
    }, [token]);
```

## 3. Providing Auth Logic
The provider exposes functions like `login`, `register`, and `logout` to all children.

```jsx
    const login = async (email, password) => {
        const { data } = await api.post('/login', { email, password });
        setToken(data.token);
        setUser(data.user);
    };

    return (
        <AuthContext.Provider value={{ user, token, login, logout }}>
            {children}
        </AuthContext.Provider>
    );
};
```
