function openTab(tabId) {
    // Hide all content
    const allTabs = document.querySelectorAll('.tab');
    const allPanes = document.querySelectorAll('.tab-pane');
    
    allTabs.forEach(tab => tab.classList.remove('active'));
    allPanes.forEach(pane => pane.classList.remove('active'));
    
    // Show the clicked tab and its corresponding content
    const activeTab = document.getElementById(tabId);
    const activePane = document.getElementById(`content-${tabId}`);
    
    activeTab.classList.add('active');
    activePane.classList.add('active');
  }

  // Set default tab to be open
  document.addEventListener("DOMContentLoaded", () => {
    openTab('tab1');
  });