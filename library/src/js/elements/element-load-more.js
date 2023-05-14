import LoadMore from '../ajax_components/loadmore'
import { HorizontalScrolling } from '../modules/horizontal-scoll';
LoadMore.init(document.querySelector('body'))
let domBody = document.querySelector('body');
let productSliders = domBody.querySelectorAll('.uni_section.uni_section__posts, .uni_section.uni_section__products')
productSliders.forEach(slider => HorizontalScrolling.init({ sliderWrapper: slider }))