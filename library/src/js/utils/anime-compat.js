import { animate, stagger } from 'animejs';

function legacyAnime(params = {}) {
  const { targets, ...rest } = params || {};
  if (!targets) {
    throw new Error('anime(): `targets` is required');
  }
  return animate(targets, rest);
}

legacyAnime.stagger = stagger;

export default legacyAnime;
