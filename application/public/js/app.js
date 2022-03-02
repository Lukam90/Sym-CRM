// jQuery-like Selectors

const $ = (id) => document.querySelector(id);
const all = (id) => document.querySelectorAll(id);

// Utilities

const deleteFlash = (event) => event.style.display = 'none';

const formatDate = (datetime) => datetime.replace(" ", "T");

const resetPage = () => window.location.reload(true);