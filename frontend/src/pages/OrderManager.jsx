import { useState, useEffect } from 'react'
import api from '../api'

const OrderManager = () => {
    const [orders, setOrders] = useState([])
    const [newItem, setNewItem] = useState('')
    const [error, setError] = useState(null)

    // Fetch orders on load
    useEffect(() => {
        fetchOrders()
    }, [])

    const fetchOrders = async () => {
        try {
            // Re-using the /hello endpoint which now returns ALL orders
            const response = await api.get('/hello');
            setOrders(response.data);
            setError(null);
        } catch (err) {
            setError('Failed to fetch orders: ' + err.message);
        }
    }

    const createOrder = async () => {
        if (!newItem.trim()) return;
        try {
            await api.post('/submit-order', { item: newItem });
            setNewItem('');
            fetchOrders(); // Refresh list
        } catch (err) {
            setError('Failed to create order: ' + err.message);
        }
    }

    const updateOrder = async (id, currentName) => {
        const newName = prompt("Enter new name:", currentName);
        if (!newName) return;

        try {
            await api.put(`/update-order/${id}`, { item: newName });
            fetchOrders(); // Refresh list
        } catch (err) {
            setError('Failed to update order: ' + err.message);
        }
    }

    const deleteOrder = async (id) => {
        if (!confirm("Are you sure you want to delete Order #" + id + "?")) return;
        try {
            await api.delete(`/cancel-order/${id}`);
            fetchOrders(); // Refresh list
        } catch (err) {
            setError('Failed to delete order: ' + err.message);
        }
    }

    return (
        <div className="container">
            <h1>Order Manager</h1>
            <p>Real Database CRUD (SQLite)</p>

            {error && <div className="error-banner" style={{ background: '#ff4444', padding: '10px', borderRadius: '8px', marginBottom: '20px' }}>{error}</div>}

            <div className="split-layout">

                {/* Left Side: Create Form */}
                <div className="glass-card">
                    <h2 style={{ marginTop: 0 }}>Create New Order</h2>
                    <p style={{ marginBottom: '1rem', opacity: 0.8 }}>Add a new item to the database.</p>
                    <div style={{ display: 'flex', flexDirection: 'column', gap: '10px' }}>
                        <input
                            type="text"
                            placeholder="Order Name (e.g. Burger)"
                            value={newItem}
                            onChange={(e) => setNewItem(e.target.value)}
                            style={{ width: '100%', boxSizing: 'border-box' }}
                        />
                        <button onClick={createOrder} style={{ width: '100%' }}>Add Order</button>
                    </div>
                </div>

                {/* Right Side: Data Table */}
                <div className="glass-card" style={{ padding: '0', overflow: 'hidden' }}>
                    <div style={{ padding: '1.5rem', borderBottom: '1px solid rgba(255,255,255,0.1)' }}>
                        <h2 style={{ margin: 0 }}>Database Records</h2>
                        <p style={{ margin: '5px 0 0 0', fontSize: '0.9em', opacity: 0.7 }}>Live data from <code>database.sqlite</code></p>
                    </div>

                    <div style={{ overflowX: 'auto' }}>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order Name</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {orders.length === 0 ? (
                                    <tr>
                                        <td colSpan="4" style={{ textAlign: 'center', padding: '2rem' }}>No orders found.</td>
                                    </tr>
                                ) : (
                                    orders.map(order => (
                                        <tr key={order.id}>
                                            <td>#{order.id}</td>
                                            <td style={{ fontWeight: 'bold' }}>{order.name}</td>
                                            <td style={{ opacity: 0.7, fontSize: '0.9em' }}>{new Date(order.created_at).toLocaleString()}</td>
                                            <td>
                                                <button
                                                    className="action-btn"
                                                    onClick={() => updateOrder(order.id, order.name)}
                                                    style={{ backgroundColor: '#646cff' }}
                                                >
                                                    Edit
                                                </button>
                                                <button
                                                    className="action-btn"
                                                    onClick={() => deleteOrder(order.id)}
                                                    style={{ backgroundColor: '#ff4444' }}
                                                >
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    ))
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    )
}

export default OrderManager
