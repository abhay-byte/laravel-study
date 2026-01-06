# Learning# React CRUD Endpoints

**[< Previous: Auth Pages](14-react-auth-pages.md) | [Next: Components & Hooks >](16-react-components-and-hooks.md)**

We use Axios to communicate with our Laravel API.

## 1. Axios Instance (`api.js`)
We configured a central Axios instance to handle the base URL.

```javascript
import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost:8000/api',
    withCredentials: true,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
});

export default api;
```

## 2. CRUD Operations
In `OrderManager.jsx`, we perform standard CRUD operations.

### Read (GET)
```javascript
const fetchOrders = async () => {
    const response = await api.get('/hello'); // Returns user's orders
    setOrders(response.data);
};
```

### Create (POST)
```javascript
await api.post('/submit-order', { item: newItemName });
```

### Update (PUT)
```javascript
await api.put(`/update-order/${id}`, { item: updatedName });
```

### Delete (DELETE)
```javascript
await api.delete(`/cancel-order/${id}`);
```

## 3. Error Handling
We use `try/catch` blocks to handle API errors, such as validation failures (422) or unauthorized access (401).
