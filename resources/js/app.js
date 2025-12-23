import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

console.log('Alpine.js loaded successfully');

// Handle logout forms with retry on CSRF error
document.addEventListener('DOMContentLoaded', function() {
    const logoutForms = document.querySelectorAll('form[action*="logout"]');
    
    logoutForms.forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(form);
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken.content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                if (response.ok || response.redirected) {
                    // Logout successful, redirect to home
                    window.location.href = '/';
                } else if (response.status === 419) {
                    // CSRF token mismatch - reload page to get new token
                    console.error('CSRF token mismatch. Reloading page...');
                    window.location.reload();
                } else {
                    console.error('Logout failed:', response.status);
                    // Fallback: try standard form submit
                    form.submit();
                }
            } catch (error) {
                console.error('Error during logout:', error);
                // Fallback: try standard form submit
                form.submit();
            }
        });
    });
});
