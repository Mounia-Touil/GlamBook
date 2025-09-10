document.addEventListener('DOMContentLoaded', () => {
    const serviceTitle = document.getElementById('serviceTitle');
    const params = new URLSearchParams(window.location.search);
    const salonId = params.get('salonId');
    serviceTitle.textContent = 'Booking for Salon #' + salonId;
  });
  
  document.getElementById('bookingForm').addEventListener('submit', (e) => {
    e.preventDefault();
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;
    const user = JSON.parse(localStorage.getItem('glam_user'));
    const appointments = JSON.parse(localStorage.getItem('glam_appointments') || '[]');
    appointments.push({ name: user.name, date, time });
    localStorage.setItem('glam_appointments', JSON.stringify(appointments));
    Swal.fire('Booked!', 'Your appointment has been booked.', 'success');
  });
  