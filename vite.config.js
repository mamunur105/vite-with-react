//import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import reactRefresh from '@vitejs/plugin-react-refresh';

import { defineConfig } from "vite";
export default defineConfig(() => ({
	plugins: [
		react(),
		reactRefresh()
	],
	build: {
		assetsDir: "",
		emptyOutDir: true,
		manifest: true,
		outDir: `./assets`,
		rollupOptions: {
			input: `./src/admin-settings.jsx`,
			output: {
				entryFileNames: `js/backend/admin-settings.js`
			}
		},
	}
}));

