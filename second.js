const div = document.createElement('div')
div.innerHTML = 'Printing from second.js: ' + window.globValue + ', order is preserved';
document.body.append(div);
