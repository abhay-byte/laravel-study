# Learning React: Initialization & Setup

## 1. Project Initialization
We used Vite to create a fast and modern React application.

```bash
npm create vite@latest frontend -- --template react
cd frontend
npm install
```

## 2. Dependencies
We installed additional packages for routing and API communication.

```bash
# Routing
npm install react-router-dom

# API Client
npm install axios
```

## 3. Project Structure
- `src/main.jsx`: Entry point, wraps App with providers.
- `src/App.jsx`: Main component, handles routing.
- `src/api.js`: Axios instance configuration.
- `src/context/`: React Contexts (e.g., AuthContext).
- `src/pages/`: Page components (Login, OrderManager).
- `src/components/`: Reusable components (Navbar, ProtectedRoute).
