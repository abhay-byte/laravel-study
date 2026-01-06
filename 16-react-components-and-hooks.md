# Learning React: Components & Hooks

This document breaks down the components used in our application, their types, and the hooks they utilize.

## 1. App Component (`src/App.jsx`)
The root component that sets up the global structure.

- **Type**: Functional Component
- **Props**: None
- **Hooks**: None
- **Responsibility**: 
    - Wraps the application in `AuthProvider`.
    - Sets up the `Router`.
    - Defines the main route configuration.

## 2. Navbar Component (`src/components/Navbar.jsx`)
The navigation bar displayed at the top of every page.

- **Type**: Functional Component
- **Props**: None
- **Hooks**: 
    - `useContext(AuthContext)`: To access `user` state and `logout` function.
- **Responsibility**:
    - Conditionally renders "Login/Register" or "User/Logout" links based on authentication state.

## 3. OrderManager Page (`src/pages/OrderManager.jsx`)
The main dashboard for managing orders.

- **Type**: Functional Component
- **Props**: None
- **Hooks**:
    - `useState`:
        - `orders`: Array to store the list of orders.
        - `newItem`: String to store the input value for new orders.
        - `error`: String/Null to handle error messages.
    - `useEffect`: Triggers `fetchOrders()` when the component mounts.
- **Responsibility**:
    - Fetches data from API.
    - Renders the order creation form.
    - Renders the orders table.
    - Handles CRUD actions (Create, Update, Delete).

## 4. AuthProvider (`src/context/AuthContext.jsx`)
A context provider that manages global authentication state.

- **Type**: Functional Component
- **Props**: `children` (The components to wrap)
- **Hooks**:
    - `useState`: Stores the `user` object and `token` string.
    - `useEffect`: Watches for changes in `token`. Syncs it with `localStorage` and updates global Axios headers.
- **Responsibility**:
    - exposes `user`, `token`, `login`, `register`, and `logout` to the rest of the app.

## 5. ProtectedRoute (`src/components/ProtectedRoute.jsx`)
A higher-order wrapper component for security.

- **Type**: Functional Component
- **Props**: `children` (The protected page)
- **Hooks**:
    - `useContext(AuthContext)`: Checks if a valid `token` exists.
- **Responsibility**:
    - If authenticated: Renders the `children`.
    - If not authenticated: Redirects to `/login` using the `<Navigate />` component.
