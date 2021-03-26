const { app, BrowserWindow } = require('electron')
const path = require('path')

function createWindow () {
  const win = new BrowserWindow({
    width: 800,
    height: 600,
    webPreferences: {
      preload: path.join(__dirname, 'preload.js')
    }
  })

  win.loadFile('index.html')
}

app.whenReady().then(() => {
  createWindow()

  app.on('activate', () => {
    if (BrowserWindow.getAllWindows().length === 0) {
      createWindow()
    }
  })
})

app.on('window-all-closed', () => {
  if (process.platform !== 'darwin') {
    app.quit()
  }
})

function exportFile () {
  const path = document.forms['mainform']['inputFiles'].files[0].path;
  const e = document.getElementById("exportType");
  let et = e.value;
  let cmd = "auto-editor " + path;

  if(et == 2){
      cmd += " --export_to_premiere";
  }else if(et == 3){
      cmd += " --export_to_final_cut_pro";
  }else if(et == 4){
      cmd += " --export_to_resolve";
  }

  const { exec } = require("child_process");

  exec(cmd, (error, stdout, stderr) => {
      if (error){
          console.log(`error: ${error.message}`);
          return;
      }
      if (stderr) {
          console.log(`stderr: ${stderr}`);
          return;
      }
      console.log(`stdout: ${stdout}`);
  });
}