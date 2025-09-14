module.exports = {
  apps: [
    {
      name: "laravel-queue",
      cwd: "D:/Programming/laragon/www/ChemicalAI",
      script: "php",
      args: "artisan queue:work --sleep=3 --tries=3 --timeout=0 --no-interaction",
      interpreter: null,
      autorestart: true,
      watch: false,
      max_restarts: 5,
      restart_delay: 5000,
    },
  ],
};
