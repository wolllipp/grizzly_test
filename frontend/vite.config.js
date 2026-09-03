import adapter from '@sveltejs/adapter-auto'
import { sveltekit } from '@sveltejs/kit/vite'
import { defineConfig } from 'vite'

const runes = (({ filename }) => {
  const pathItems = filename.split(/[/\\]/)
  const doesInclude = pathItems.includes('node_modules')
  return doesInclude ? undefined : true
})

const sveltekitConfig = {
  compilerOptions: { runes },
  adapter: adapter()
}

const plugins = [sveltekit(sveltekitConfig)]
const config = { plugins }

export default defineConfig(config)
