function showHide() {
  if(document.getElementById('meer').style.display == 'block') {
    document.getElementById('meer').style.display = 'none';
    document.getElementById('minder').style.display = 'block';
  } else if(document.getElementById('meer').style.display == 'none') {
    document.getElementById('meer').style.display = 'block';
    document.getElementById('minder').style.display = 'none';
  }
}
