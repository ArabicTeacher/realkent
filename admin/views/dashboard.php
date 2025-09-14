<div class="dashboard-container">
    <h2>Dashboard Overview</h2>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Properties</h3>
            <p class="stat-number"><?php echo $properties; ?></p>
        </div>
        
        <div class="stat-card">
            <h3>Total Users</h3>
            <p class="stat-number"><?php echo $users; ?></p>
        </div>
        
        <div class="stat-card">
            <h3>Recent Activity</h3>
            <p class="stat-number">5</p>
        </div>
    </div>
    
    <div class="recent-properties">
        <h3>Recent Properties</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Date Added</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentProperties as $property): ?>
                <tr>
                    <td><?php echo $property->id; ?></td>
                    <td><?php echo ucfirst($property->type); ?></td>
                    <td>$<?php echo number_format($property->price); ?></td>
                    <td><?php echo date('M j, Y', strtotime($property->created_at)); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>