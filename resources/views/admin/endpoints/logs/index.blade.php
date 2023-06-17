<x-app-layout>
  <x-slot name="header">
      <div class="flex">
          <h2 class="mx-4 text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
              {{ __("Logs do endpoint {$endpoint->endpoint}") }}
          </h2>
      </div>
  </x-slot>

  <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
          <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                  <x-alerts/>
                  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                          <tr>
                              <th scope="col" class="px-6 py-6">Status</th>
                              <th scope="col" class="px-6 py-6">Data</th>
                              <th scope="col" class="px-6 py-6">Response</th>
                          </tr>
                      </thead>
                      <tbody>
                          @forelse ($checks as $check)
                              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                  <td class="px-6 py-4">{{ $check->status_code }}</td>
                                  <td class="px-6 py-4">{{ $check->created_at }}</td>
                                  <td class="px-6 py-4">{{ $check->response_body ?? '-' }}</td>
                              </tr>
                          @empty
                              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                  <td colspan="100">Sem Logs</td>
                              </tr>
                          @endforelse
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>