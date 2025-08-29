<?php

namespace App\Mail;

use App\Models\Admission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdmissionQualified extends Mailable
{
    use Queueable, SerializesModels;

    public Admission $admission;

    public function __construct(Admission $admission)
    {
        $this->admission = $admission;
    }

    public function build(): self
    {
        return $this->subject('Congratulations! You are Qualified for Admission')
            ->view('emails.admission_qualified')
            ->with([
                'studentName' => $this->admission->first_name . ' ' . $this->admission->last_name,
                'programName' => $this->admission->program->program_name ?? 'your chosen program',
                'admissionId' => $this->admission->admission_id,
            ]);
    }
}
