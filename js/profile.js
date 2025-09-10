
document.addEventListener('DOMContentLoaded', () => {
  const currentUser = JSON.parse(localStorage.getItem('glam_current_user'));
  // if (!currentUser) {
  //   alert('Please log in.');
  //   window.location.href = 'login.html';
  //   return;
  // }

  document.getElementById('profileName').textContent = currentUser.name;
  document.getElementById('profileEmail').textContent = currentUser.email;
  document.getElementById('profilePhone').textContent = currentUser.phone;
  document.getElementById('profileDOB').textContent = currentUser.dob;

  const appointments = JSON.parse(localStorage.getItem('glam_appointments') || '[]');
  const userAppointments = appointments.filter(a => a.user === currentUser.username);

  const list = document.getElementById('appointmentsList');
  if (userAppointments.length === 0) {
    list.innerHTML = '<li class="list-group-item">No appointments yet.</li>';
  } else {
    userAppointments.forEach(app => {
      const item = document.createElement('li');
      item.className = 'list-group-item';
      item.textContent = `${app.service} on ${app.date} at ${app.time}`;
      list.appendChild(item);
    });
  }

  document.getElementById('logoutBtn').addEventListener('click', () => {
    localStorage.removeItem('glam_current_user');
    window.location.href = 'index.html';
  });
});