import "flowbite";

import "flatpickr/dist/flatpickr.min.css";

import "@fancyapps/ui/dist/fancybox/fancybox.css";
import "@fancyapps/ui/dist/carousel/carousel.css";
import "@fancyapps/ui/dist/carousel/carousel.arrows.css";
import "@fancyapps/ui/dist/carousel/carousel.autoplay.css";
import "@fancyapps/ui/dist/carousel/carousel.thumbs.css";
import "@fancyapps/ui/dist/carousel/carousel.dots.css";

import { Editor } from "@tiptap/core";
import { Placeholder } from "@tiptap/extensions";
import { Color, TextStyle } from "@tiptap/extension-text-style";

import Bold from "@tiptap/extension-bold";
import StarterKit from "@tiptap/starter-kit";
import Highlight from "@tiptap/extension-highlight";
import TextAlign from "@tiptap/extension-text-align";

import flatpickr from "flatpickr";
import { Indonesian } from "flatpickr/dist/l10n/id";

import { Fancybox } from "@fancyapps/ui/dist/fancybox";
import { Carousel } from "@fancyapps/ui/dist/carousel";
import { Dots } from "@fancyapps/ui/dist/carousel/carousel.dots";
import { Arrows } from "@fancyapps/ui/dist/carousel/carousel.arrows";
import { Autoplay } from "@fancyapps/ui/dist/carousel/carousel.autoplay";
import { Lazyload } from "@fancyapps/ui/dist/carousel/carousel.lazyload";

window.setupEditor = (content) => {
  const CustomBold = Bold.extend({
    renderHTML({ mark, HTMLAttributes }) {
      const { style, ...rest } = HTMLAttributes;

      const newStyle = `font-weight: bold; ${style ? ` ${style}` : ""}`;

      return ["span", { ...rest, style: newStyle.trim() }, 0];
    },
    addOptions() {
      return {
        ...this.parent?.(),
        HTMLAttributes: {},
      };
    },
  });

  const FontSizeTextStyle = TextStyle.extend({
    addAttributes() {
      return {
        fontSize: {
          default: null,
          parseHTML: (element) => element.style.fontSize,
          renderHTML: (attributes) => {
            if (!attributes.fontSize) {
              return {};
            }

            return { style: `font-size: ${attributes.fontSize}` };
          },
        },
      };
    },
  });

  return {
    content: content,
    init(element) {
      const editor = new Editor({
        element: element,
        extensions: [
          StarterKit.configure({
            bold: false,
            marks: {
              bold: false,
            },
            link: {
              defaultProtocol: "https",
            },
          }),
          CustomBold,
          Highlight,
          TextStyle,
          Color,
          FontSizeTextStyle,
          Placeholder.configure({
            placeholder: "kegiatan ini blablablabla",
          }),
          TextAlign.configure({
            types: ["paragraph"],
            alignments: ["left", "center", "right"],
          }),
        ],
        content: this.content,
        onUpdate: ({ editor }) => {
          this.content = editor.getHTML();
        },
        editorProps: {
          attributes: {
            class: "format lg:format-lg dark:format-invert focus:outline-none format-blue max-w-none",
          },
        },
      });

      // buat fungsi toolbar
      this.toggleBold = () => editor.chain().focus().toggleBold().run();
      this.toggleItalic = () => editor.chain().focus().toggleItalic().run();
      this.toggleUnderline = () => editor.chain().focus().toggleUnderline().run();
      this.toggleStrike = () => editor.chain().focus().toggleStrike().run();
      this.toggleHighlight = () => editor.chain().focus().toggleHighlight().run();
      this.setLink = () => {
        const href = prompt("Masukkan Link");
        editor.chain().focus().toggleLink({ href }).run();
      };
      this.unsetLink = () => editor.chain().focus().unsetLink().run();
      this.setColor = (color) => editor.chain().focus().setColor(color).run();
      this.resetColor = () => editor.chain().focus().unsetColor().run();
      this.toggleAlign = (align) => editor.chain().focus().toggleTextAlign(align).run();
      this.toggleBulletList = () => editor.chain().focus().toggleBulletList().run();
      this.toggleOrderedList = () => editor.chain().focus().toggleOrderedList().run();
      this.toggleBlockquote = () => editor.chain().focus().toggleBlockquote().run();
      this.toggleHorizontalRule = () => editor.chain().focus().setHorizontalRule().run();

      this.$watch("content", (content) => {
        // If the new content matches Tiptap's then we just skip.
        if (content === editor.getHTML()) return;
        editor.commands.setContent(content, false);
      });
    },
  };
};

// // Init flatpickr
flatpickr(".datepicker", {
  locale: Indonesian,
  maxDate: "today",
  mode: "single",
  static: true,
  monthSelectorType: "static",
  dateFormat: "j F Y",
  defaultDate: [new Date()],
  prevArrow:
    '<svg class="stroke-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.25 6L9 12.25L15.25 18.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
  nextArrow:
    '<svg class="stroke-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.75 19L15 12.75L8.75 6.5" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
});

if (document.getElementById("myCarousel")) {
  Carousel(
    document.getElementById("myCarousel"),
    {
      Autoplay: {
        showProgressbar: false,
        timeout: 3000,
      },
      Dots: {
        maxCount: 25,
      },
    },
    {
      Arrows,
      Autoplay,
      Lazyload,
      Dots,
    },
  ).init();

  Fancybox.bind("[data-fancybox]", {});
}
