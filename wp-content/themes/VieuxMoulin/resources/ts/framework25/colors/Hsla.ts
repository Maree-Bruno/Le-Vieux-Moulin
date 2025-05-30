import {settings} from "../settings";
import {iColor} from "../types/iColor";

export class Hsla implements iColor {

    private _hue: number;
    private _saturation: number;
    private _lightness: number;
    private _alpha: number;

    constructor(hue: number, saturation: number, lightness: number, alpha: number) {
        this.hue = hue;
        this.saturation = saturation;
        this.lightness = lightness;
        this.alpha = alpha;
    }

    set lightness(value: number) {
        if (value >= 0 && value <= 100) {
            this._lightness = value;
        } else {
            this._lightness = settings.defaultColorValue;
        }
    }

    get lightness() {
        return Math.trunc(this._lightness);
    }


    get hue(): number {
        return Math.trunc(this._hue);
    }

    set hue(value: number) {
        if (value >= 0 && value <= 360) {
            this._hue = value;
        } else {
            this._hue = settings.defaultColorValue;
        }
    }

    get saturation(): number {
        return Math.trunc(this._saturation);
    }

    set saturation(value: number) {
        if (value >= 0 && value <= 100) {
            this._saturation = value;
        } else {
            this._saturation = settings.defaultColorValue;
        }
    }

    get alpha(): number {
        return this._alpha;
    }

    set alpha(value: number) {
        if (value >= 0 && value <= 1) {
            this._alpha = value;
        } else {
            this._alpha = settings.defaultColorValue;
        }
    }

    toString() {
        return `hsl(${this.hue}deg,${this.saturation}%,${this.lightness}%,${this.alpha})`
    }

}

