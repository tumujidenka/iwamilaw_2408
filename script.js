document.addEventListener("DOMContentLoaded", function() {
    const pathName = location.pathname;

    if (pathName.match("articlelist")) {
        const siteBodyContainer = document.querySelector('.site-body-container');
        if (siteBodyContainer) {
            siteBodyContainer.classList.add('flexpart');
        } else {
            console.warn('.site-body-container クラスが見つかりませんでした');
        }
    }
});


// 日付を◯年◯月◯日→◯/◯/◯に変換
document.addEventListener("DOMContentLoaded", function() {
    // articleDateとpostList_dateクラスを持つすべての要素を取得
    const dateElements = document.querySelectorAll('.articleDate, .postList_date');

    // 各要素に対してループを実行
    dateElements.forEach(function(dateElement) {
        // 日付のテキストを取得
        let originalDate = dateElement.textContent;

        // 正規表現で「年」「月」「日」を「/」に変換
        let formattedDate = originalDate.replace(/年/g, '/').replace(/月/g, '/').replace(/日/g, '');

        // 変換後のテキストを要素に再設定
        dateElement.textContent = formattedDate;
    });
});