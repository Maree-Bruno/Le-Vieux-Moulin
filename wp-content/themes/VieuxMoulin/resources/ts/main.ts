import {fancybox} from "./fancybox/fancybox";
import {Game} from "./bubble/Game";

window.addEventListener("Load", () => {
    new Game();
    fancybox();
});