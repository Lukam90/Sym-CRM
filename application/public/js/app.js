/**
 * jQuery-like simple selector
 * 
 * @param {string} value
 * 
 * @returns HTMLElement
 */
const $ = (value) => document.querySelector(value);

/**
 * jQuery-like "all" selector
 * 
 * @param {string} value
 * 
 * @returns {HTMLElement[]}
 */
const all = (value) => document.querySelectorAll(value);

/**
 * Deletes a flash message
 * 
 * @param {HTMLElement} message
 */
const deleteFlash = (message) => message.style.display = 'none';

/**
 * Formats an event date
 * 
 * @param {string} datetime
 * 
 * @returns {string}
 */
const formatDate = (datetime) => datetime.replace(" ", "T");

/**
 * Reloads the page (search filter)
 */
const resetPage = () => window.location.reload(true);