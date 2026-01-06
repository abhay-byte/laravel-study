# Learning React: Auth Pages

We created specific pages for Login and Registration that interact with our `AuthContext`.

## 1. Login Page
The login page captures credentials and calls the `login` function from context.

```jsx
const Login = () => {
    const { login } = useContext(AuthContext);
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await login(email, password);
            // Redirect after success
        } catch (error) {
            // Handle error
        }
    };

    return (
        <form onSubmit={handleSubmit}>
            <input type="email" value={email} onChange={(e) => setEmail(e.target.value)} />
            <input type="password" value={password} onChange={(e) => setPassword(e.target.value)} />
            <button type="submit">Login</button>
        </form>
    );
};
```

## 2. Register Page
Similar to login, but includes a name field and calls `register`.

## 3. Protected Route Wrapper
We created a `ProtectedRoute` component to prevent unauthenticated access.

```jsx
const ProtectedRoute = ({ children }) => {
    const { token } = useContext(AuthContext);
    
    if (!token) return <Navigate to="/login" />;
    
    return children;
};
```
