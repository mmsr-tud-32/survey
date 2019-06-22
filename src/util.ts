const preLoaded: HTMLImageElement[] = [];

export function preload(images: string[]) {
  for (const image of images) {
    const imageEl = new Image();
    imageEl.src = image;

    preLoaded.push(imageEl);
  }
}
