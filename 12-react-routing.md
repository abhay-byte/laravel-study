# Learning# React Routing

**[< Previous: React Initialization](11-react-initialization.md) | [Next: Auth Context >](13-react-auth-context.md)**

We use `react-router-dom` to manage navigation in our Single Page Application (SPA).

## 1. Router Setup
In `src/App.jsx`, we wrap our application with `BrowserRouter`.

```jsx
import { BrowserRouter, Routes, Route } from 'react-router-dom';

function App() {
  return (
    <BrowserRouter>
      <Navbar />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/login" element={<Login />} />
        {/* Protected Routes */}
        <Route path="/orders" element={
            <ProtectedRoute>
                <OrderManager />
            </ProtectedRoute>
        } />
      </Routes>
    </BrowserRouter>
  );
}
```

## 2. Navigation
We use the `Link` component to navigate without reloading the page.

```jsx
import { Link } from 'react-router-dom';

<Link to="/login">Login</Link>
```

## 3. Redirection
The `Navigate` component is used to redirect users programmatically.

```jsx
import { Navigate } from 'react-router-dom';

if (!token) {
    return <Navigate to="/login" replace />;
}
```
