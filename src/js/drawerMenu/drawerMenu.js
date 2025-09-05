/**
 * ドロワーメニューのボタン押下でパネルを開閉する機能を追加。
 * @param {string} buttonId
 * @param {string} panelId
 * @param {int} minWidth
 * @param {string} activeClassName
 * @returns
 */
export function toggleDrawerMenu(buttonId, panelId, minWidth, activeClassName) {
  // ボタン取得
  const button = document.getElementById(buttonId);
  // パネル取得
  const panel = document.getElementById(panelId);

  if (!button || !panel) {
    console.log(
      "toggleDrawerMenu() : id=" +
        buttonId +
        "の要素、または、id=" +
        panelId +
        "の要素が見つかりません"
    );
    return false;
  }

  //初期化
  initializeDrawerMenuPanel(panel, minWidth, activeClassName);
  initializeButton(button);
  document.body.style.overflow = "";

  // クリックイベントに引っ掛ける処理
  button.addEventListener("click", () => {
    // ボタンの状態をスイッチ
    button.ariaExpanded = String(button.ariaExpanded !== "true");
    // 確認
    console.log(button.ariaExpanded);

    // ボタンの状態によりパネルの状態を変更
    if (button.ariaExpanded === "true") {
      activatePanel(panel, activeClassName);
      console.log("panel is opened");
    } else {
      deactivatePanel(panel, activeClassName);
      console.log("panel is closed");
    }
  });

  // リサイズイベントに引っかける処理
  window.matchMedia("(min-width: " + minWidth + "px)").addEventListener("change", (e) => {
    if (e.matches) {
      // panel.ariaHidden = "false";
      // button.ariaExpanded = "false";
      deactivatePanel(panel, activeClassName);
      initializeButton(button);
      console.log("button and panel are reset for large screens.");
    }
  });

  return true;
}

/**
 *
 * @param {HTMLElement} panel
 * @param {string} activeClassName
 */
function deactivatePanel(panel, activeClassName) {
  panel.ariaHidden = "true";
  panel.classList.remove(activeClassName);
  document.body.style.overflow = "";
}

function activatePanel(panel, activeClassName) {
  panel.ariaHidden = "false";
  panel.classList.add(activeClassName);
  document.body.style.overflow = "hidden";
}

/** ************************************************
 * ビューポート幅が minWidth 未満か否かを判定し、メニューパネルの状態を初期化する。
 *
 * @param {HtmlElement} panelElment
 * @param {int} minWidth
 */
function initializeDrawerMenuPanel(panelElment, minWidth, activeClassName) {
  panelElment.classList.remove(activeClassName);

  if (window.innerWidth < minWidth) {
    panelElment.ariaHidden = "true";
  } else {
    panelElment.ariaHidden = "false";
  }
}

/**
 *
 * @param {HTMLElement} buttonElm
 * @param {int} minWidth
 */
function initializeButton(buttonElm) {
  buttonElm.ariaExpanded = "false";
}

/** ****************************************************
 * クリックするとパネルが閉じる機能。同一ページのidにジャンプするメニュー項目に付ける。
 *
 * @param {string} anchorSelector
 * @param {string} drawerButtonId
 * @param {string} drawerPanelId
 * @returns {boolean}
 */
export function closePanel(anchorSelector, drawerButtonId, drawerPanelId) {
  const anchors = document.querySelectorAll(anchorSelector);
  if (anchors.length === 0) {
    return false;
  }
  anchors.forEach((e) => {
    e.addEventListener("click", () => {
      const button = document.getElementById(drawerButtonId);
      const panel = document.getElementById(drawerPanelId);
      button.ariaExpanded = "false";
      panel.ariaHidden = "true";
      document.body.style.overflow = "";
    });
  });
  return true;
}
