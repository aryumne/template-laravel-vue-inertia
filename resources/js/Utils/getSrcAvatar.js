export default function getSrcAvatar(path) {
    let src = import.meta.env.VITE_APP_URL;
    if (path !== null) return src + "/storage/" + path;
    else return src + "/assets/img/avatar/avatar-1.png";
}
