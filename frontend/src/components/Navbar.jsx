import { Link } from 'react-router-dom';
import { useContext } from 'react';
import { AuthContext } from '../context/AuthContext';

const Navbar = () => {
    const { user, logout } = useContext(AuthContext);

    return (
        <nav style={{
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'center',
            padding: '1rem 2rem',
            background: 'rgba(0,0,0,0.3)',
            backdropFilter: 'blur(10px)',
            borderBottom: '1px solid rgba(255,255,255,0.1)',
            marginBottom: '2rem'
        }}>
            <div style={{ fontSize: '1.5rem', fontWeight: 'bold', color: '#42d392' }}>
                Laravel<span style={{ color: 'white' }}>Study</span>
            </div>
            <div style={{ display: 'flex', gap: '2rem', alignItems: 'center' }}>
                <Link to="/" style={{ color: 'white', textDecoration: 'none', fontWeight: 500 }}>Home</Link>
                <Link to="/orders" style={{ color: 'white', textDecoration: 'none', fontWeight: 500 }}>Order Manager</Link>

                {user ? (
                    <div style={{ display: 'flex', gap: '1rem', alignItems: 'center' }}>
                        <span style={{ opacity: 0.7 }}>Hi, {user.name}</span>
                        <button onClick={logout} style={{ padding: '0.4rem 0.8rem', fontSize: '0.9em' }}>Logout</button>
                    </div>
                ) : (
                    <div style={{ display: 'flex', gap: '1rem' }}>
                        <Link to="/login" style={{ color: 'white', textDecoration: 'none' }}>Login</Link>
                        <Link to="/register" style={{ color: '#42d392', textDecoration: 'none' }}>Register</Link>
                    </div>
                )}
            </div>
        </nav>
    );
};

export default Navbar;

