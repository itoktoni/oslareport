<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class WebhookController extends Controller
{
    public function deploy(Request $request)
    {
        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');
        $localToken = env('GITHUB_WEBHOOK_SECRET');
        $localHash = 'sha1='.hash_hmac('sha1', $githubPayload, $localToken, false);
        if (hash_equals($githubHash, $localHash)) {

            chdir(base_path());
            $process = new Process(['git', 'pull']);
            $process->run();

            // executes after the command finishes
            if (! $process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return $process->getOutput();
        }
    }
}
