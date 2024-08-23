<?php
session_start();

// Function to check if the user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

if (isLoggedIn()) {
    $user_id = $_SESSION['user_id'];

    // Fetch user profile data
    $select_profile = $conn->prepare("SELECT * FROM tbl_user WHERE user_id = ?");
    $select_profile->execute([$user_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

    // Return the user profile data as JSON
    echo json_encode(['success' => true, 'name' => $fetch_profile['name']]);
} else {
    echo json_encode(['success' => false]);
}
?>

<script>
    function updateProfile() {
    fetch('update_profile.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the profile information on the page
                document.querySelector('.profile .name').textContent = data.name;
                // ... other updates
            } else {
                console.error('Error updating profile');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

// Call the updateProfile function after successful login
// For example, if you're using a login form:
document.getElementById('loginForm').addEventListener('submit', (event) => {
    // ... login logic
    updateProfile();
});
</script>