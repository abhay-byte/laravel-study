const Home = () => {
    return (
        <div className="container">
            <h1>Welcome to Laravel Study</h1>
            <p style={{ fontSize: '1.2rem', opacity: 0.8, maxWidth: '600px', margin: '0 auto' }}>
                This is a full-stack educational project connecting a <strong>Laravel 11 Backend</strong> with a <strong>React + Vite Frontend</strong>.
            </p>

            <div className="card-grid" style={{ marginTop: '4rem' }}>
                <div className="glass-card">
                    <h2>📚 Learn</h2>
                    <p>Explore the simplified documentation in the repo to understand Laravel's core concepts.</p>
                </div>

                <div className="glass-card">
                    <h2>🚀 Experiment</h2>
                    <p>Use the <strong>Order Manager</strong> to test real-time CRUD operations with a SQLite database.</p>
                </div>

                <div className="glass-card">
                    <h2>🎨 Design</h2>
                    <p>Enjoy the premium glassmorphism UI powered by modern CSS.</p>
                </div>
            </div>
        </div>
    );
};

export default Home;
