document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('registerForm');
    const loginForm = document.getElementById('loginForm');
  
    if (registerForm) {
      registerForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(registerForm);
        const newUser = {
          name: formData.get('name'),
          email: formData.get('email'),
          phone: formData.get('phone'),
          dob: formData.get('dob'),
          username: formData.get('username'),
          password: formData.get('password'),
        };
  
        const users = JSON.parse(localStorage.getItem('glam_users') || '[]');
        const exists = users.some(u => u.username === newUser.username);
        if (exists) {
          alert('Username already exists!');
          return;
        }
  
        users.push(newUser);
        localStorage.setItem('glam_users', JSON.stringify(users));
        alert('Registration successful! You can now log in.');
        window.location.href = 'login.html';
      });
    }
  
    if (loginForm) {
      loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(loginForm);
        const username = formData.get('username');
        const password = formData.get('password');
  
        const users = JSON.parse(localStorage.getItem('glam_users') || '[]');
        const user = users.find(u => u.username === username && u.password === password);
  
        if (user) {
          localStorage.setItem('glam_current_user', JSON.stringify(user));
          alert('Login successful!');
          window.location.href = 'home.html';
        } else {
          alert('Invalid username or password');
        }
      });
    }
  });