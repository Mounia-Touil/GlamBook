document.addEventListener('DOMContentLoaded', () => {
    const currentUser = JSON.parse(localStorage.getItem('glam_current_user'));
    if (!currentUser) {
      alert('Please login first.');
      window.location.href = 'login.html';
      return;
    }
  
    const urlParams = new URLSearchParams(window.location.search);
    const service = urlParams.get('service');
    document.getElementById('serviceName').innerText = service;
  
    const bookingForm = document.getElementById('bookingForm');
    bookingForm.addEventListener('submit', (e) => {
      e.preventDefault();
  
      const formData = new FormData(bookingForm);
      const date = formData.get('date');
      const time = formData.get('time');
  
      const appointment = {
        user: currentUser.username,
        service,
        date,
        time,
        bookedAt: dayjs().format()
      };
  
      const allAppointments = JSON.parse(localStorage.getItem('glam_appointments') || '[]');
      allAppointments.push(appointment);
      localStorage.setItem('glam_appointments', JSON.stringify(allAppointments));
  
      emailjs.send("your_service_id", "your_template_id", {
        to_name: currentUser.name,
        message: `You've booked a ${service} on ${date} at ${time}`,
        to_email: currentUser.email
      });
  
      Swal.fire('Booked!', `Your ${service} appointment is confirmed.`, 'success').then(() => {
        window.location.href = 'profile.html';
      });
    });
  });